## Fix the first descent

Write `n` as digits `d`.

1. Find the first `i` with `d[i] > d[i + 1]`. If none, `n` is already monotone; return it.
2. While `i > 0` and `d[i − 1] == d[i]`, move `i` back. Decrementing the leftmost copy keeps the prefix monotone.
3. `d[i] −= 1`, then set `d[i + 1 …]` to 9.

A right-to-left version does the same: whenever `d[i − 1] > d[i]`, decrement `d[i − 1]` and remember `i` as where the 9s start, then fill from the leftmost such mark.

Example: `332` → first drop at index 1, step back to index 0 → `2`, then `99` → `299`.

Do not decrement only the digit at the drop; `332` → `329` is not monotone. Do not count down from `n` checking each number; `n` can be 10⁹.

Time: O(digits)  
Space: O(digits)

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
