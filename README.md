# Cards&Shots 🍻🎴

## Descripción 🎮

**Cards&Shots** es un juego de cartas en línea donde los jugadores deben enfrentarse a retos y desafíos mientras eligen entre realizar una prueba o beber una cantidad de alcohol. Totalmente libre de publicidad y accesible desde el navegador, ¡este juego es perfecto para disfrutar con amigos sin distracciones molestas! 🍹💥

Con hasta **8 jugadores**, el juego se basa en una secuencia de turnos, donde cada jugador debe decidir si acepta el reto o se va por la opción más fácil... ¡beber! 🥂

## Reglas del Juego 📜

1. **Jugadores**: El juego es para un máximo de **8 jugadores**.
2. **Turnos**: Los jugadores se turnan en un orden secuencial. Durante su turno, un jugador saca una carta que contiene un desafío.
3. **Cartas**: Cada carta le dará al jugador la opción de:
   - Realizar una prueba (de mímica, preguntas, habilidad física, etc.)
   - O, si prefiere, beber una cantidad de alcohol 🍷
4. **Pruebas**: Las pruebas son divertidas y variadas, ¡y es mucho más divertido si las haces!
5. **Beber**: Si decides no realizar la prueba, simplemente tomas un trago y sigues jugando.

¡La dinámica es simple, pero las risas están aseguradas! 🎉

## Tecnologías Utilizadas 🔧

- **Backend**: PHP, Symfony (MVC)
- **Frontend**: HTML, JavaScript, Tailwind o Bootstrap , CSS
- **Base de Datos**: MySQL (para gestionar jugadores, cartas y reglas del juego)
- **Comunicaciones en Tiempo Real**: AJAX o WebSockets (dependiendo de la implementación final)

## Flujo de Datos 🔄

1. **Jugador inicia sesión**: Los jugadores se registran y se unen al juego.
2. **Turno de juego**: Cada jugador, al llegar su turno, recibe una carta aleatoria a través de AJAX o WebSocket.
3. **Decisión del jugador**: El jugador debe decidir entre realizar la prueba o beber.
4. **Actualización de estado**: El servidor actualiza el estado del juego y pasa el turno al siguiente jugador.

## Instalación y Configuración ⚙️

1. **Clonar el repositorio**:

    ```bash
    git clone https://github.com/tu_usuario/cards-and-shots.git
    cd cards-and-shots
    ```

2. **Instalar dependencias con Composer (Symfony)**:

    ```bash
    composer install
    ```

3. **Configuración de la base de datos**:

    Asegúrate de tener una base de datos MySQL configurada. Puedes usar las siguientes credenciales en tu archivo `.env` o configurarlas según tus necesidades:

    ```
    DATABASE_URL=mysql://usuario:contraseña@127.0.0.1:3306/cards_and_shots
    ```

4. **Levantar el servidor de desarrollo de Symfony**:

    ```bash
    symfony serve
    ```

5. **Abrir la aplicación en tu navegador**:

    La aplicación estará disponible en `http://localhost:8000`.

## Cómo Jugar 🎉

1. Un jugador crea una nueva partida y comparte el enlace con los demás jugadores.
2. Los jugadores se unen a la partida desde el enlace.
3. El juego comienza cuando todos los jugadores están listos.
4. En cada turno, un jugador sacará una carta y decidirá entre hacer la prueba o beber un trago.
5. ¡Las risas están garantizadas hasta el final del juego!

## Futuras Características 🚀

1. **Interacciones entre jugadores**: Implementaremos enfrentamientos y otras interacciones entre jugadores.
2. **Modo sin alcohol**: Permitiremos jugar sin bebidas alcohólicas para quienes prefieran no consumirlas.
3. **Modificación de cartas**: Los jugadores podrán personalizar sus cartas y los desafíos.

## Contribuciones 🤝

¡Las contribuciones son bienvenidas! Si tienes alguna sugerencia o mejora, por favor crea un **pull request** o abre un **issue**. Asegúrate de seguir las reglas básicas de contribución y pruebas antes de enviar cambios.

## Licencia 📜

Este proyecto está bajo la Licencia MIT. Para más detalles, revisa el archivo [LICENSE](LICENSE).

---

¡Diviértete jugando a **Cards&Shots**! 🎉🍻
