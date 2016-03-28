/**
 * Created by brand on 3/28/2016.
 */
"use strict";
var color_array = [0xff0000, 0x00ff00, 0x0000ff];
var color_index = 0;
class Piece {
    constructor(container, i, j) {
        if (color_index % 2 == 1) {
            this.values = [
                [0, 0],
                [0, 1],
                [1, 0],
                [1, 1]
            ]
        } else {
            this.values = [
                [0, 0],
                [0, 1],
                [1, 1],
                [1, 2]
            ]
        }
        this.i = 0;
        this.j = 0;
        this.color = color_array[color_index];
        color_index = (color_index + 1) % 3
    }
    down() {
        this.j++
    }
    up() {
        this.j--
    }
    left() {
        this.i--;
        if (this.i < 0) {
            this.i = 0
        }
    }
    right() {
        this.i++;
        if (this.i > 9) {
            this.i = 9
        }
    }
    draw(matrix) {
        for (var i = 0; i < this.values.length; i++) {
            var cell = matrix[this.i + this.values[i][0]][this.j + this.values[i][1]];
            cell.visible = true;
            cell.color = this.color;
            cell.draw()
        }
    }
    fill(matrix) {
        for (var i = 0; i < this.values.length; i++) {
            var cell = matrix[this.i + this.values[i][0]][this.j + this.values[i][1]];
            cell.visible = true;
            cell.color = this.color;
            cell.filled = true;
            cell.draw()
        }
    }
    conflict(matrix) {
        for (var i = 0; i < this.values.length; i++) {
            var i_offset = this.i + this.values[i][0];
            var j_offset = this.j + this.values[i][1];
            if (j_offset >= 20) return true;
            var cell = matrix[i_offset][j_offset];
            console.log(cell);
            if (cell.filled) return true
        }
        return false
    }
}
class Cell {
    constructor(container, i, j) {
        this.square = new PIXI.Graphics();
        container.addChild(this.square);
        this.square.x = i * 25;
        this.square.y = j * 25;
        this.square.mouseover = function() {
            console.log("mouse over")
        };
        this.filled = false;
        this.color = 0xffffff
    }
    draw() {
        this.square.clear();
        this.square.beginFill(this.color);
        this.square.drawRect(0, 0, 25, 25);
        this.square.endFill()
    }
    set visible(value) {
        this.square.visible = value
    }
}
class Tetris {
    constructor(stage) {
        console.log("constructor for tetris");
        this.board = new PIXI.Sprite();
        this.outline = new PIXI.Graphics();
        this.board.x = 50;
        this.board.y = 50;
        this.draw_outline();
        this.board.addChild(this.outline);
        this.build_matrix(this.board);
        stage.addChild(this.board);
        this.current_piece = new Piece();
        this.draw_piece();
        document.addEventListener('keydown', this.handle_key_presses.bind(this))
    }
    handle_key_presses(key) {
        if (key.code == "ArrowDown") {
            this.current_piece.down();
            if (this.current_piece.conflict(this.board_matrix)) {
                this.current_piece.up();
                this.current_piece.fill(this.board_matrix);
                this.current_piece = new Piece();
                this.draw_piece()
            }
        }
        if (key.code == "ArrowLeft") {
            this.current_piece.left();
            if (this.current_piece.conflict(this.board_matrix)) {
                this.current_piece.right()
            }
        }
        if (key.code == "ArrowRight") {
            this.current_piece.right();
            if (this.current_piece.conflict(this.board_matrix)) {
                this.current_piece.left()
            }
        }
        this.clear_board();
        this.draw_piece()
    }
    draw_piece() {
        this.current_piece.draw(this.board_matrix)
    }
    build_matrix(container) {
        this.board_matrix = [];
        for (var i = 0; i < 10; i++) {
            this.board_matrix[i] = [];
            for (var j = 0; j < 20; j++) {
                this.board_matrix[i][j] = new Cell(container, i, j);
                this.board_matrix[i][j].visible = false
            }
        }
    }
    clear_board() {
        for (var i = 0; i < 10; i++) {
            for (var j = 0; j < 20; j++) {
                this.board_matrix[i][j].draw();
                if (this.board_matrix[i][j].filled) {
                    this.board_matrix[i][j].visible = true
                } else {
                    this.board_matrix[i][j].visible = false
                }
            }
        }
    }
    draw_outline() {
        this.outline.clear();
        this.outline.lineStyle(2, 0xCCCCCC);
        this.outline.beginFill();
        this.outline.drawRect(0, 0, 250, 500);
        this.outline.endFill()
    }
}
var stage;
var renderer;

function doit() {
    $("body").append("hello")
}

function after_load() {
    stage = new PIXI.Container();
    stage.interactive = true;
    renderer = PIXI.autoDetectRenderer(500, 1000, null);
    document.body.appendChild(renderer.view);
    requestAnimationFrame(animate);
    new Tetris(stage)
}

function animate() {
    requestAnimationFrame(animate);
    renderer.render(stage)
}
after_load();