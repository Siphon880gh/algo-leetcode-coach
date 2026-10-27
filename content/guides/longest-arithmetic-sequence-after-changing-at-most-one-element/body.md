## Runs plus joins

1. le[i] / ri[i]: longest arithmetic run ending / starting at i.
2. best = min(n, max(le) + 1).
3. For i in 1 … n − 2 with nums[i + 1] − nums[i − 1] even: d = half of it. L = le[i − 1] if the step into i − 1 is d, else 1. Rr = ri[i + 1] if the step out of i + 1 is d, else 1. best = max(best, L + 1 + Rr).
4. Return best.

Examples → 5, 3. Checked against trying replacements on 1,200 random arrays.

Only extending runs, never joining: example 1 → 4 instead of 5.

Time: O(n)  
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
