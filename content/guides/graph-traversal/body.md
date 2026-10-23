## Tiny example

Undirected edges: `A—B`, `A—C`, `B—D`.

**BFS from A** (queue): visit order example `A, B, C, D` (level by level).

**DFS from A** (stack/recursion): one possible order `A, B, D, C` (go deep before siblings).


## How

1. Mark nodes visited to avoid cycles
2. BFS: queue neighbors; process in FIFO order
3. DFS: recurse (or stack) on an unvisited neighbor before the next sibling


## Trap

Forgetting the visited set on an undirected graph — infinite ping-pong on `A—B`.

**Fix:** Mark when you enqueue (BFS) or when you recurse (DFS). Never reprocess a visited node.

**Time:** O(V+E) · **Space:** O(V)

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
