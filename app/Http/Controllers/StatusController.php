<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use function GuzzleHttp\json_decode;

class StatusController extends Controller
{
    public function __invoke()
    {
        $resultJava = $this->checkJavaPrograms();
        $resultDocker = $this->checkDockerContainer();
        $resultServices = $this->checkServices();

        $result = array_merge($resultJava, $resultDocker, $resultServices);


        return response()->json($result);
    }

    /**
     * @return mixed
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\ProcessSignaledException
     * @throws \Symfony\Component\Process\Exception\ProcessTimedOutException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    private function checkJavaPrograms()
    {
        $processes = ['Injector', 'ETL_L1', 'ETL_L2', 'ETL_L3'];
        foreach ($processes as $process) {
            $processCmd = new Process(['jcmd', $process]);
            $processCmd->run();
            $processCmd->wait();

            $result[$process] = $processCmd->isSuccessful();
        }
        return $result;
    }

    private function checkDockerContainer()
    {
        $processes = ['kafka_kafka1_1', 'kafka_zoo1_1'];
        foreach ($processes as $process) {
            $processCmd = new Process(['docker', 'inspect', $process]);
            $processCmd->run();
            $processCmd->wait();

            if (!$processCmd->isSuccessful()) {
                $result[$process] = false;
            } else {
                $output = json_decode(rtrim($processCmd->getOutput(), "\n"));
                $result[$process] = $output[0]->State->Running;
            }

        }
        return $result;
    }

    private function checkServices()
    {
        $processes = ['redis-server', 'mongodb'];
        foreach ($processes as $process) {
            $processCmd = new Process(['service', $process, 'status']);
            $processCmd->run();
            $processCmd->wait();

            $result[$process] = $processCmd->isSuccessful();
        }
        return $result;
    }
}
