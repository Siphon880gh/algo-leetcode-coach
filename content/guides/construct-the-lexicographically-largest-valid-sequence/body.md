## Greedy order, backtrack on failure

1. Array of length `2n − 1`; `used` flags.
2. At the first empty position `i`, try `v = n … 1` unused: `v = 1` takes `i`; `v > 1` needs `i + v` in range and free.
3. Recurse; undo on failure. Return the first complete array.

`n = 3` → `[3,1,2,3,2]`. `n = 5` → `[5,3,1,4,3,5,2,4,2]`.

Trying larger values first makes the first success the largest. n ≤ 20 keeps the search fast in practice.

Time: exponential worst case, fast for n ≤ 20  
Space: O(n)

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
