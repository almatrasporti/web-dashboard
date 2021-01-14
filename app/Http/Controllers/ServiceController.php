<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class ServiceController extends Controller
{
    public function start(Request $request)
    {
        $processCmd = new Process(['sh', config('app.cmd_path'). $request->service . '.sh', config('app.cmd_path')]);
        $processCmd->start();
//        $processCmd->wait();/
//        $res = $processCmd->getOutput();
//
//        return $res;

    }

    public function kill(Request $request)
    {
        $processCmd = new Process(["ps", "-aux"]);
        $processCmd->start();
        $processCmd->wait();
        $res = $processCmd->getOutput();

        $processCmd = new Process(["grep", $request->service]);
        $processCmd->setInput($res);
        $processCmd->start();
        $processCmd->wait();
        $res = $processCmd->getOutput();

        $pid = (int)explode("  ", $res)[1];

        $processCmd = new Process(["kill", $pid]);
        $processCmd->start();
        $processCmd->wait();

        return $pid;
    }
}
