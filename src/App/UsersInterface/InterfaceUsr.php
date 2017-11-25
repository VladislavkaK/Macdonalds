<?php

namespace App\UsersInterface;

use App\Order;
use App\Menu;

class InterfaceUsr implements IInterface
{
    const START = 'start';
    const LIST = 'list';
    const ADD = 'add';
    const REMOVE = 'remove';
    const RETURN = 'return';
    const FINISH = 'finish';
    const CHECK = 'check';


    private $order;

    private $state;

    public function __construct()
    {
        $this->state = self::START;
        $this->order = new Order();
    }


    public function run(): void
    {
        while (true) {
            if ($this->state === self::START) {
                echo '���� ' . PHP_EOL;
                echo '������� list, ����� ���������� ���� ' . PHP_EOL;
                while (($line = trim(fgets(STDIN))) != self::FINISH) {
                    switch ($line) {
                        case self::END:
                            return;
                        case self::LIST:
                            echo $this->getList() . PHP_EOL;
                            echo '������� add, ����� �������� ������� ' . PHP_EOL;
                            break;
                        case self::ADD:
                            $this->state = self::ADD;
                            break 2;
                        case self::FINISH:
                            echo '��������� ��������!' . PHP_EOL;
                            return;
                    }
                }
            } elseif ($this->state === self::ADD) {
                // ����������
                echo '����� �������� ������� �������: id ������, ����������' . PHP_EOL;
                while (($line = trim(fgets(STDIN))) != self::FINISH) {
                    switch ($line) {
                        case self::END:
                            return;
                        case self::RETURN:
                            $this->state = self::START;
                            break 2;
                        case self::LIST:
                            echo $this->getList();
                            break;
                        case self::CHECK:
                            echo $this->order->getCheck();
                            break;
                        case self::REMOVE:
                            $this->state = self::REMOVE;
                            break 2;
                        default:
                            $param = explode(',', $line);
                            if (count($param) === 2) {
                                $this->order->add(Menu::getProducts($param[0]), $param[1]);
                                echo $this->order->getCheck();
                            } else {
                                echo '����������� �������� ���������, ���������� �����' . PHP_EOL;
                            }
                            break;
                    }
                }
            } elseif ($this->state === self::REMOVE) {
                // ��������
                echo '����� ������� ������� ������� ����� �������' . PHP_EOL;
                while (($line = trim(fgets(STDIN))) != self::FINISH) {
                    switch ($line) {
                        case self::RETURN:
                            $this->state = self::START;
                            break 2;
                        case self::CHECK:
                            echo $this->order->getCheck();
                            break;
                        default:
                            try {
                                $this->order->remove((int) $line - 1);
                                echo $this->order->getCheck();
                            } catch (\Exception $e) {
                                echo '����������� �������� ���������, ���������� �����' . PHP_EOL;
                            }

                            break;
                    }
                }
            }


        }
    }

    private function getList(): string
    {
        return Menu::getAll();
    }

}