## Reachable range

1. Unvisited, unbanned positions go into two sorted sets by parity; `ans[p] = 0`.
2. BFS from `p`. For position `i`: `L = max(i − k + 1, k − i − 1)`, `R = min(i + k − 1, 2n − k − i − 1)`.
3. Take every unvisited position in `[L, R]` from the set with `L`’s parity; set its answer to `ans[i] + 1`, enqueue it and remove it.
4. Return `ans` (−1 where never reached).

Examples → [0,−1,−1,1], [0,−1,−1,−1,−1], [−1,−1,0,−1]. Checked against a BFS that tries every window on 500 random cases.

A window starting at s sends i to 2s + k − 1 − i, so targets step by 2; the bounds come from keeping the window inside the array. Removing visited positions keeps the total work near-linear; a next-pointer union-find over each sorted list does the same.

Time: O(n log n)  
Space: O(n)

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
