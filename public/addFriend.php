<?php

                    require_once '../config/init.php';
                    

                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $search = $_POST['search'];
                        $username = $_POST['username']; 

                    
                        if (empty($username) || empty($search)) {
                            // Handle the error here. For example, you can redirect back with an error message.
                            header("Location: ./usuario.php?mensaje=El usuario introducido no existe");
                            exit();
                        }
                        echo 'El usuario introducido no existe o ya ha sido añadido';
                    
                        $db = DbConnection::getInstance()->getConnection();

                        $stmt = $db->prepare("INSERT INTO friends (USER_NAME, FRIEND_NAME) VALUES (:user, :searchedUser)");
                        $result = $stmt->execute([$username, $search]);
                    
                        if ($result) {
                            // Redirect to index.php on success
                            header("Location: ./usuario.php?mensaje=Valoración añadida correctamente");
                            exit();
                        } else {
                            // Echo error message on failure
                            echo "Error: " . $stmt->errorInfo()[2];
                        }
                    }