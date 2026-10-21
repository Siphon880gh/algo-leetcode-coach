## Retrograde analysis

State `(m, c, t)` with `t` = mouse or cat to move. Results: MOUSE, CAT, or DRAW (unknown).

**Known states:**

- `m == 0` (mouse in the hole): MOUSE wins.
- `m == c` with `c ≠ 0`: CAT wins.

**Degrees:** for each state, count the mover's legal moves. The cat may not enter node 0.

**Propagation (BFS from the known states):** for a resolved state `S` with result `R`, look at each parent `P` (a state whose mover can reach `S` in one move):

- If `P`'s mover is the winner of `R`, `P` gets `R`.
- Otherwise decrement `P`'s degree; at 0, every move loses, so `P` gets `R`.

Enqueue `P` when it is resolved. Answer the start state `(1, 2, mouse)`: 1 for mouse, 2 for cat, 0 for draw.

Do not run a depth-limited DFS with memo; the game has cycles, and a cut-off depth can mislabel states. Do not let the cat move into the hole.

Time: O(n³) (n² positions × 2 turns × up to n moves)  
Space: O(n²)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
