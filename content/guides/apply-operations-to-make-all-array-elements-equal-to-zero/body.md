## Left to right

1. `cur` = active decrement, `d` = difference array.
2. At i: `cur += d[i]`; `v = nums[i] − cur`. If v < 0, return false. If v > 0: if `i + k > n`, return false; `cur += v`, `d[i + k] −= v`.
3. Return true.

Examples → true, false. Checked against direct window subtraction on 500 random arrays.

Applying each window by looping over its k cells is O(n · k), about 2.5 · 10^9 cell updates when k = n / 2; the difference array makes each start O(1).

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
