<?php
declare(strict_types=1);

(function (): void {
    $requestPath = rtrim((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    $publicBase = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'), '/');

    if ($requestPath !== $publicBase && !str_starts_with($requestPath, $publicBase . '/')) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $dest = isset($_SESSION['auth']['id']) ? 'home' : 'auth.login';
        header('Location: ' . $publicBase . '/index.php?route=' . $dest);
        exit;
    }
})();

require_once __DIR__ . '/../Common/ClassLoader.php';
require_once __DIR__ . '/../Common/DependencyInjection.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/CreateCarreraAcademicaRequest.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateCarreraAcademicaRequest.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php';

DependencyInjection::boot();
Flash::start();

function isLoggedIn(): bool
{
    return isset($_SESSION['auth']['id']);
}

function buildHomeViewData(?string $message = null): array
{
    return array(
        'pageTitle' => 'Inicio',
        'message' => $message ?? Flash::message(),
        'success' => Flash::success(),
    );
}

function buildCreateCarreraViewData(): array
{
    return array(
        'pageTitle' => 'Registrar carrera académica',
        'message' => Flash::message(),
        'success' => Flash::success(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

function buildLoginViewData(): array
{
    return array(
        'pageTitle' => 'Iniciar sesión',
        'message' => Flash::message(),
        'success' => Flash::success(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

function buildCreateCarreraAcademicaRequestFromPost(): CreateCarreraAcademicaRequest
{
    return new CreateCarreraAcademicaRequest(
        trim((string) ($_POST['nombre'] ?? '')),
        trim((string) ($_POST['numCreditos'] ?? '')),
        trim((string) ($_POST['numAsignaturas'] ?? '')),
        trim((string) ($_POST['numSemestres'] ?? '')),
        trim((string) ($_POST['nivelFormacion'] ?? '')),
        trim((string) ($_POST['titulo'] ?? '')),
        trim((string) ($_POST['valorSemestre'] ?? '')),
        trim((string) ($_POST['universidad'] ?? '')),
        trim((string) ($_POST['esAcreditada'] ?? '')),
        trim((string) ($_POST['perfiles'] ?? '')),
        trim((string) ($_POST['areaConocimiento'] ?? ''))
    );
}

function buildUpdateCarreraAcademicaRequestFromPost(): UpdateCarreraAcademicaRequest
{
    return new UpdateCarreraAcademicaRequest(
        trim((string) ($_POST['id'] ?? '')),
        trim((string) ($_POST['nombre'] ?? '')),
        trim((string) ($_POST['numCreditos'] ?? '')),
        trim((string) ($_POST['numAsignaturas'] ?? '')),
        trim((string) ($_POST['numSemestres'] ?? '')),
        trim((string) ($_POST['nivelFormacion'] ?? '')),
        trim((string) ($_POST['titulo'] ?? '')),
        trim((string) ($_POST['valorSemestre'] ?? '')),
        trim((string) ($_POST['universidad'] ?? '')),
        trim((string) ($_POST['esAcreditada'] ?? '')),
        trim((string) ($_POST['perfiles'] ?? '')),
        trim((string) ($_POST['areaConocimiento'] ?? ''))
    );
}

function buildLoginWebRequestFromPost(): LoginWebRequest
{
    return new LoginWebRequest(
        trim((string) ($_POST['email'] ?? '')),
        trim((string) ($_POST['password'] ?? ''))
    );
}

function createCarreraRequestToArray(CreateCarreraAcademicaRequest $request): array
{
    return array(
        'nombre' => $request->nombre(),
        'numCreditos' => $request->numCreditos(),
        'numAsignaturas' => $request->numAsignaturas(),
        'numSemestres' => $request->numSemestres(),
        'nivelFormacion' => $request->nivelFormacion(),
        'titulo' => $request->titulo(),
        'valorSemestre' => $request->valorSemestre(),
        'universidad' => $request->universidad(),
        'esAcreditada' => $request->esAcreditada(),
        'perfiles' => $request->perfiles(),
        'areaConocimiento' => $request->areaConocimiento(),
    );
}

function updateCarreraRequestToArray(UpdateCarreraAcademicaRequest $request): array
{
    return array(
        'id' => $request->id(),
        'nombre' => $request->nombre(),
        'numCreditos' => $request->numCreditos(),
        'numAsignaturas' => $request->numAsignaturas(),
        'numSemestres' => $request->numSemestres(),
        'nivelFormacion' => $request->nivelFormacion(),
        'titulo' => $request->titulo(),
        'valorSemestre' => $request->valorSemestre(),
        'universidad' => $request->universidad(),
        'esAcreditada' => $request->esAcreditada(),
        'perfiles' => $request->perfiles(),
        'areaConocimiento' => $request->areaConocimiento(),
    );
}

function loginWebRequestToArray(LoginWebRequest $request): array
{
    return array(
        'email' => $request->email(),
    );
}

function validateCreateCarreraRequest(CreateCarreraAcademicaRequest $request): array
{
    $errors = array();

    $fields = array(
        'nombre' => $request->nombre(),
        'numCreditos' => $request->numCreditos(),
        'numAsignaturas' => $request->numAsignaturas(),
        'numSemestres' => $request->numSemestres(),
        'nivelFormacion' => $request->nivelFormacion(),
        'titulo' => $request->titulo(),
        'valorSemestre' => $request->valorSemestre(),
        'universidad' => $request->universidad(),
        'esAcreditada' => $request->esAcreditada(),
        'perfiles' => $request->perfiles(),
        'areaConocimiento' => $request->areaConocimiento(),
    );

    foreach ($fields as $field => $value) {
        if ($value === '') {
            $errors[$field] = 'Este campo es obligatorio.';
        }
    }

    return $errors;
}

function validateUpdateCarreraRequest(UpdateCarreraAcademicaRequest $request): array
{
    $errors = validateCreateCarreraRequest(
        new CreateCarreraAcademicaRequest(
            $request->nombre(),
            $request->numCreditos(),
            $request->numAsignaturas(),
            $request->numSemestres(),
            $request->nivelFormacion(),
            $request->titulo(),
            $request->valorSemestre(),
            $request->universidad(),
            $request->esAcreditada(),
            $request->perfiles(),
            $request->areaConocimiento()
        )
    );

    if ($request->id() === '') {
        $errors['id'] = 'El identificador es obligatorio.';
    }

    return $errors;
}

function validateLoginWebRequest(LoginWebRequest $request): array
{
    $errors = array();

    if ($request->email() === '') {
        $errors['email'] = 'El correo es obligatorio.';
    }

    if ($request->password() === '') {
        $errors['password'] = 'La contraseña es obligatoria.';
    }

    return $errors;
}

function getCarreraFormData(): array
{
    return array(
        'id' => trim((string) ($_POST['id'] ?? '')),
        'nombre' => trim((string) ($_POST['nombre'] ?? '')),
        'numCreditos' => trim((string) ($_POST['numCreditos'] ?? '')),
        'numAsignaturas' => trim((string) ($_POST['numAsignaturas'] ?? '')),
        'numSemestres' => trim((string) ($_POST['numSemestres'] ?? '')),
        'nivelFormacion' => trim((string) ($_POST['nivelFormacion'] ?? '')),
        'titulo' => trim((string) ($_POST['titulo'] ?? '')),
        'valorSemestre' => trim((string) ($_POST['valorSemestre'] ?? '')),
        'universidad' => trim((string) ($_POST['universidad'] ?? '')),
        'esAcreditada' => trim((string) ($_POST['esAcreditada'] ?? '')),
        'perfiles' => trim((string) ($_POST['perfiles'] ?? '')),
        'areaConocimiento' => trim((string) ($_POST['areaConocimiento'] ?? '')),
    );
}

function getLoginFormData(): array
{
    return array(
        'email' => trim((string) ($_POST['email'] ?? '')),
        'password' => trim((string) ($_POST['password'] ?? '')),
    );
}

function validateCreateCarreraForm(array $form): array
{
    $errors = array();

    $requiredFields = array(
        'nombre',
        'numCreditos',
        'numAsignaturas',
        'numSemestres',
        'nivelFormacion',
        'titulo',
        'valorSemestre',
        'universidad',
        'esAcreditada',
        'perfiles',
        'areaConocimiento',
    );

    foreach ($requiredFields as $field) {
        if ($form[$field] === '') {
            $errors[$field] = 'Este campo es obligatorio.';
        }
    }

    return $errors;
}

function buildForgotPasswordViewData(): array
{
    return array(
        'pageTitle' => 'Recuperar contraseña',
        'message' => Flash::message(),
        'success' => Flash::success(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

function sendPasswordRecoveryEmail(string $email, string $name, string $tempPassword): void
{
    $templateFile = __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Views/emails/forgot-password.php';

    ob_start();
    extract(
        array(
            'email' => $email,
            'name' => $name,
            'tempPassword' => $tempPassword,
        ),
        EXTR_SKIP
    );
    require $templateFile;
    $htmlBody = (string) ob_get_clean();

    $subject = '=?UTF-8?B?' . base64_encode('Recuperación de contraseña') . '?=';
    $headers = implode("\r\n", array(
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: Carrera Académica <no-reply@carrera-academica.local>',
    ));

    @mail($email, $subject, $htmlBody, $headers);
}

function validateLoginForm(array $form): array
{
    $errors = array();

    if ($form['email'] === '') {
        $errors['email'] = 'El correo es obligatorio.';
    }

    if ($form['password'] === '') {
        $errors['password'] = 'La contraseña es obligatoria.';
    }

    return $errors;
}

$route = isset($_GET['route']) ? trim((string) $_GET['route']) : 'home';
$routes = WebRoutes::routes();

if (!isset($routes[$route])) {
    http_response_code(404);
    View::render('home', buildHomeViewData('Ruta no encontrada.'));
    exit;
}

$definition = $routes[$route];
$httpMethod = strtoupper((string) $_SERVER['REQUEST_METHOD']);

if ($httpMethod !== $definition['method']) {
    http_response_code(405);
    View::render('home', buildHomeViewData('Método HTTP no permitido.'));
    exit;
}

$publicActions = array(
    'home',
    'login',
    'authenticate',
    'logout',
    'forgot',
    'forgot.send'
);

if (!in_array($definition['action'], $publicActions, true) && !isLoggedIn()) {
    Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
    View::redirect('auth.login');
}

try {
    switch ($definition['action']) {
        case 'home':
            $controller = DependencyInjection::getCarreraAcademicaController();
            View::render('home', $controller->home());
            break;

        case 'create':
            $controller = DependencyInjection::getCarreraAcademicaController();
            View::render('carreras/create', $controller->create());
            break;

        case 'store':
            $controller = DependencyInjection::getCarreraAcademicaController();
            $request = buildCreateCarreraAcademicaRequestFromPost();
            $errors = validateCreateCarreraRequest($request);

            if (!empty($errors)) {
                Flash::setOld(createCarreraRequestToArray($request));
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                View::redirect('carreras.create');
            }

            $controller->store($request);
            Flash::setSuccess('Carrera académica registrada correctamente.');
            View::redirect('carreras.index');
            break;

        case 'index':
            $controller = DependencyInjection::getCarreraAcademicaController();
            View::render('carreras/list', $controller->index());
            break;

        case 'edit':
            $controller = DependencyInjection::getCarreraAcademicaController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            View::render('carreras/edit', $controller->edit($id));
            break;

        case 'update':
            $controller = DependencyInjection::getCarreraAcademicaController();
            $request = buildUpdateCarreraAcademicaRequestFromPost();
            $errors = validateUpdateCarreraRequest($request);

            if (!empty($errors)) {
                Flash::setOld(updateCarreraRequestToArray($request));
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                View::redirect('carreras.edit&id=' . urlencode($request->id()));
            }

            $controller->update($request);
            Flash::setSuccess('Carrera académica actualizada correctamente.');
            View::redirect('carreras.index');
            break;

        case 'delete':
            $controller = DependencyInjection::getCarreraAcademicaController();
            $id = trim((string) ($_POST['id'] ?? ''));

            if ($id === '') {
                Flash::setMessage('El identificador es obligatorio.');
                View::redirect('carreras.index');
            }

            $controller->delete($id);
            Flash::setSuccess('Carrera académica eliminada correctamente.');
            View::redirect('carreras.index');
            break;

        case 'login':
            View::render('auth/login', buildLoginViewData());
            break;

        case 'authenticate':
        $request = buildLoginWebRequestFromPost();
        $errors = validateLoginWebRequest($request);

        if (!empty($errors)) {
            Flash::setOld(loginWebRequestToArray($request));
            Flash::setErrors($errors);
            Flash::setMessage('Corrige los errores del formulario.');
            View::redirect('auth.login');
        }

        $command = new LoginCommand($request->email(), $request->password());
        $user = DependencyInjection::getLoginUseCase()->execute($command);

        $_SESSION['auth'] = array(
            'id' => $user->id()->value(),
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'role' => $user->role(),
        );

        Flash::setSuccess('Inicio de sesión exitoso.');
        View::redirect('home');
        break;

        case 'logout':
            unset($_SESSION['auth']);
            Flash::setSuccess('Sesión cerrada correctamente.');
            View::redirect('auth.login');
            break;

case 'forgot':
    View::render('auth/forgot-password', buildForgotPasswordViewData());
    break;
    
case 'show':
    $controller = DependencyInjection::getCarreraAcademicaController();
    $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';

    if ($id === '') {
        Flash::setMessage('Debes seleccionar una carrera para ver el detalle.');
        View::redirect('carreras.index');
    }

    View::render('carreras/show', $controller->show($id));
    break;

case 'forgot.send':
    $email = trim((string) ($_POST['email'] ?? ''));

    if ($email === '') {
        Flash::setOld(array('email' => ''));
        Flash::setErrors(array('email' => 'El correo es obligatorio.'));
        Flash::setMessage('Corrige los errores del formulario.');
        View::redirect('auth.forgot');
    }

    $command = new ForgotPasswordCommand($email);
    $result = DependencyInjection::getForgotPasswordUseCase()->execute($command);

    if ($result !== null) {
        sendPasswordRecoveryEmail(
            (string) $result['email'],
            (string) $result['name'],
            (string) $result['tempPassword']
        );
    }

    Flash::setSuccess('Si el correo existe y está activo, se generó una contraseña temporal y se envió la recuperación.');
    View::redirect('auth.forgot');
    break;

        default:
            http_response_code(404);
            View::render('home', buildHomeViewData('Acción no implementada.'));
            break;
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo '<pre style="white-space:pre-wrap;font-family:monospace;">';
    echo 'ERROR REAL:' . "\n\n";
    echo htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "\n\n";
    echo 'Archivo: ' . htmlspecialchars($e->getFile(), ENT_QUOTES, 'UTF-8') . "\n";
    echo 'Línea: ' . $e->getLine() . "\n\n";
    echo $e->getTraceAsString();
    echo '</pre>';
    exit;
}