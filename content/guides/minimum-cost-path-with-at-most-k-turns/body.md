## Example first

grid = [[2, 7, 3], [1, 4, 5]], k = 1.

| Moves | Turns | Cost |
|-------|-------|------|
| down, right, right | 1 | 2 + 1 + 4 + 5 = 12 |
| right, right, down | 1 | 2 + 7 + 3 + 5 = 17 |
| right, down, right | 2 | not allowed |

Answer 12.

## Why the cell alone is not enough

Two paths can reach the same cell with different headings or different turn counts. The cheaper one may have used more turns and be stuck later. So a state is (row, col, heading, turns used). Every cost is ≥ 0, so Dijkstra works.

## Steps

1. A 1 × 1 grid costs grid[0][0].
2. Seed the heap with each first move from (0, 0). That move sets the heading and uses 0 turns. Cost = grid[0][0] + the new cell.
3. Pop the cheapest state. Moving the same way keeps the turn count; a new direction adds 1. Skip moves off the grid or past k turns. Revisiting cells is allowed and costs again.
4. The first time the bottom-right cell is popped, its cost is the answer. If it never is, return −1.

At most 75 · 75 · 4 · 75 ≈ 1.7 million states.

## Trap

Ignoring turns and running Dijkstra on cells only. Example 3 gives 8 (path 1, 3, 4 with one turn) instead of −1, and Example 2 gives 18 instead of 20. Fix: keep heading and turns in the state.

Checked: the examples give 12, 20 and −1, and the heap search matched repeated relaxation over the same states on 300 random grids.

Time: O(S log S) with S = m · n · 4 · (k + 1)  
Space: O(S)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
