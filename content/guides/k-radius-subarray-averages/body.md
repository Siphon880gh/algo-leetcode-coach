## Fixed window

1. `w = 2k + 1`, `ans = [−1] · n`, `s = 0`.
2. For `i`: `s += nums[i]`; if `i ≥ w`, `s −= nums[i − w]`; if `i ≥ w − 1`, `ans[i − k] = s // w`.

Examples → `[-1,-1,-1,5,4,4,-1,-1,-1]`, `[100000]`, `[-1]`.

Values are non-negative, so `//` is the truncating division the statement asks for. The sum of `2k + 1` values up to 10^5 can exceed 32 bits. If `w > n`, every entry stays −1.

Time: O(n)  
Space: O(1) besides the output

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
