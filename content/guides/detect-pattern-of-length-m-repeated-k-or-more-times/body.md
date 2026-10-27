## Shifted comparison

1. `c = 0`; for `i` in 0..n − m − 1: `c = c + 1` if `arr[i] == arr[i + m]`, else 0.
2. If `c == m · (k − 1)`, return true.

`[1,2,4,4,4,4]`, m = 1, k = 3 → true. `[1,2,1,2,1,1,1,3]`, m = 2, k = 2 → true. `[1,2,1,2,1,3]`, m = 2, k = 3 → false.

Do not require the streak to start at a multiple of m. Brute force over starts is O(n · m · k) and also passes for n ≤ 100.

Time: O(n)  
Space: O(1)

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
