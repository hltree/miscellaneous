<?php

namespace Classes\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class TicketsController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $sql = 'SELECT * FROM tickets';
        $stmt = $this->db->query($sql);
        $tickets = [];
        while($row = $stmt->fetch()) {
            $tickets[] = $row;
        }
        $data = ['tickets' => $tickets];
        return $this->renderer->render($response, 'tickets/index.phtml', $data);
    }

    public function create(Request $request, Response $response)
    {
        $subject = $request->getParsedBodyParam('subject');
        // ここに保存の処理を書く
        $sql = 'INSERT INTO tickets (subject) values (:subject)';
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(['subject' => $subject]);
        if(!$result) {
            throw new \Exception('could not save the ticket');
        }
        // 保存が正常にできたら一覧ページへリダイレクトする
        return $response->withRedirect('/tickets');
    }
}