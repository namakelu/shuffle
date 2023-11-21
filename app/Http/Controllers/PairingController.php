<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PairingHistory;
use Illuminate\Http\Request;


class PairingController extends Controller
{
    public function generatePairings()
    {
        $people = Employee::pluck('name')->toArray();
        $groupSizes = [2, 2, 2, 3];
        $pastPairings = PairingHistory::pluck('pairing')->toArray();

        $newPairings = $this->generatePairingsLogic($people, $groupSizes, $pastPairings);

        // データベースに新しい組み合わせを保存
        PairingHistory::create(['pairing' => json_encode($newPairings)]);

        // 生成された組み合わせをビューに返すなどの処理
        return view('index', compact('newPairings'));
    }

    private function generatePairingsLogic($people, $groupSizes, $pastPairings)
    {
        $allPairings = $this->generateAllPairings($people, $groupSizes);
        $uniquePairings = $this->filterUniquePairings($allPairings, $pastPairings);

        // データベースに新しい組み合わせを保存するなどの処理
        // savePairingsToDatabase($uniquePairings);

        return $uniquePairings;
    }

    private function generateAllPairings($people, $groupSizes)
    {
        shuffle($people);

        $pairings = [];
        $currentIndex = 0;

        foreach ($groupSizes as $groupSize) {
            $pairing = array_slice($people, $currentIndex, $groupSize);
            $currentIndex += $groupSize;
            $pairings[] = $pairing;
        }

        return $pairings;
    }

    private function filterUniquePairings($newPairings, $pastPairings)
    {
        $uniquePairings = [];

        foreach ($newPairings as $pairing) {
            if (count(array_intersect($pairing, explode(',', $pastPairings))) > 0) {
                $uniquePairings[] = $pairing;
            }
        }

        return $uniquePairings;
    }

    private function hasOverlap($pairing, $pastPairings)
    {
        foreach ($pastPairings as $pastPairing) {
            if (count(array_intersect($pairing, $pastPairing)) > 0) {
                return true;
            }
        }

        return false;
    }
}