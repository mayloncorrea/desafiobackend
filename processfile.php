<?php

    $errors = [];
    $error = false;

    try {

        $file = $_FILES['file_to_precess'];
        // var_dump($file['type'] == 'text/plain');exit;
        if($file['type'] <> 'text/plain') {
            throw new \Exception("Extensão do arquivo inválida, apenas arquivos do tipo texto (.txt)");
        }

        $file = fopen($file['tmp_name'], 'r');
        $fileProcessed = processFile($file);
        
        $qtdCases = isset($fileProcessed[0]) ? intval($fileProcessed[0]) : null;

        if(!$qtdCases) {
            throw new \Exception('É necessário na primeira linha do arquivo um número maior que 0 representando quantidade de casos');
        }

        $cases = array_slice($fileProcessed, 1);
        
        if(sizeof($cases) % 2 !== 0) {
            throw new \Exception('Os casos não estão formatados da maneira correta, abaixo da primeira linha do arquivo deve-se atribuir para cada caso uma linha com a quantidade e outra com os itens sepadados por espaço');
        }

        $casesFormated = formatCasesByArray($cases);

        if(sizeof($casesFormated) <> $qtdCases) {
            throw new \Exception('A quantidade de casos setada na linha N° 1 não condiz com os casos abaixo');            
        }

        $casesResult = [];

        foreach($casesFormated as $key => $case) {

            $caseNumber = $key + 1;
            if($case['qtd_collumns'] <> sizeof($case['collumns'])) {
                $casesInline = implode(' ', $case['collumns']);
                $errors[] = "O tamanho indicado do caso N° $caseNumber difere da quantidade existente ($casesInline)";
            }

            $width = $case['qtd_collumns'];
            $heigth = max($case['collumns']);
            $spaceToFill = $width * $heigth;

            $result = $spaceToFill - array_sum($case['collumns']);
            array_push($casesResult, $result);
        }
        if(sizeof($errors)) {
            throw new \Exception('Existem erros no arquivo: ');
        }

        
    } catch (\Exception $e) {
        
        $error = true;
        $errorMessage = $e->getMessage();
        // var_dump($errorMessage);exit;
    }

    include('fileResult.phtml');

    function formatCasesByArray($cases)
    {
        $qtdCases = sizeof($cases);
        
        $formatedCases = [];
        for($i = 0; $i < $qtdCases; $i = $i+2) {
            $case = [
                'qtd_collumns' => intval($cases[$i]),
                'collumns' => array_map('intval', explode(' ', $cases[$i+1]))
            ];
            array_push($formatedCases, $case);
        }
        return $formatedCases;
    }

    function processFile($file)
    {
        $currentLine = 0;
        $arrLines = [];
        while (($line = fgets($file)) !== false && $currentLine < 100) 
        {
            $currentLine++;
            $line = preg_replace( "/\r|\n/", "", $line);    
            array_push($arrLines, $line);
        }
        return $arrLines;
    }  
    
    function removeBreakLine($str)
    {
        return preg_replace( "/\r|\n/", "", $str);    
    }

    function dd($var) 
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }