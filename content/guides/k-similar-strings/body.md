## Shortest path over strings

Each string is a node and each swap is an edge, so the fewest swaps is a BFS distance.

From a string `cur`:

1. Find the first `i` with `cur[i] != goal[i]`.
2. For each `j > i` with `cur[j] == goal[i]` and `cur[j] != goal[j]`, swap `i` and `j` to get a neighbor.
3. Skip neighbors already seen.

Return the level at which `goal` is dequeued (0 if `s == goal`).

Fixing the first mismatch is safe: some optimal sequence fixes it next, and only swaps that put the right letter there need trying. Requiring `cur[j] != goal[j]` skips swaps that break an already correct position.

Do not try all pairs `(i, j)`; the frontier explodes. Do not use a greedy swap without search; picking the wrong partner can cost extra swaps.

Time: exponential in the worst case, fast for length ≤ 20 over six letters  
Space: the number of strings visited

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
