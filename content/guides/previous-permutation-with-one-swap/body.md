## Smallest change as far right as possible

1. Scan from the right for the first `i` with `arr[i] > arr[i + 1]`. If none, return `arr` (already the smallest).
2. Among `j > i`, pick the largest `arr[j] < arr[i]`. Among equal values, take the leftmost one.
3. Swap `arr[i]` and `arr[j]`.

The suffix after `i` is non-decreasing, so you can scan right from `i + 1` while values stay below `arr[i]`.

Do not take the rightmost copy of a repeated value; swapping the leftmost keeps the result larger. Do not swap adjacent elements only; the best swap partner may be far right.

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
