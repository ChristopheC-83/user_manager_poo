<div class="container">
    <h1>Gestion des Droits</h1>
    
    
    <table class="usersArray">
    
        <thead>
            <tr>
                <th>
                    <h4>Pseudo</h4>
                </th>
                <th>
                    <h4>Validé</h4>
                </th>
                <th>
                    <h4>Rôle</h4>
                </th>
                <th>
                    <h4>Mail</h4>
                </th>
            </tr>
    
            <?php foreach ($infoUsers as $user) : ?>
    
                <tr>
                    <td>
                        <p><?= $user['login'] ?></p>
                    </td>
    
                    <td>
                        <?php if ($user['role'] === "admin") : ?>
    
                            <p>Toujours prêt !</p>
    
                        <?php else : ?>
                            <form action="<?= URL ?>administrator/modify_state" method="POST">
                                <input type="hidden" name="login" value="<?= $user['login'] ?>">
                                <select name="is_valid" name="is_valid" onchange="confirmation(this.form)">
                                    <option value=1 <?= $user['is_valid'] === 1 ? "selected" : "" ?>>Validé</option>
                                    <option value=0 <?= $user['is_valid'] === 0 ? "selected" : "" ?>>Non validé</option>
                                </select>
                            </form>
                        <?php endif ?>
    
                    </td>
    
    
                    <td>
                        <?php if ($user['role'] === "admin") : ?>
                            <p><?= $user['role'] ?></p>
    
                        <?php else : ?>
                            <form action="<?= URL ?>administrator/modify_role" method="POST">
                                <input type="hidden" name="login" value="<?= $user['login'] ?>">
                                <select name="role" name="role" onchange="confirmation(this.form)">
                                    <option value="user" <?= $user['role'] === "user" ? "selected" : "" ?>>Utilisateur</option>
                                    <option value="editor" <?= $user['role'] === "editor" ? "selected" : "" ?>>Editeur</option>
                                    <option value="admin" <?= $user['role'] === "admin" ? "selected" : "" ?>>Administrateur</option>
                                </select>
                            </form>
    
    
    
    
                        <?php endif ?>
    
                    </td>
    
    
                    <td>
                        <p><?= $user['mail'] ?></p>
                    </td>
    
                    <td>
                        <form action="<?= URL ?>administrator/delete_account_user" method="post">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer => <?= $user['login'] ?> ?')">
                                Supprimer</button>
                            <input type="hidden" name="login" value="<?= $user['login'] ?>">
                        </form>
                    </td>
    
                </tr>
    
    
            <?php endforeach ?>
    
    
    
        </thead>
    
    
    
    
    </table>
</div>