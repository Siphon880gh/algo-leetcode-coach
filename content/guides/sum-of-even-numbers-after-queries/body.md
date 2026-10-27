## Adjust, do not recompute

`even = sum(x for x in nums if x % 2 == 0)`.

For each query `(val, i)`:

1. If `nums[i]` is even, `even −= nums[i]`.
2. `nums[i] += val`.
3. If `nums[i]` is even, `even += nums[i]`.
4. Record `even`.

Negative numbers work the same way: −4 is even. In languages where `%` can return −1 for negatives, test evenness with `x % 2 == 0`; never test oddness with `x % 2 == 1`.

Do not recompute the sum after each query; that is O(n · q). Do not forget to remove the old value even when the new one is also even.

Time: O(n + q)  
Space: O(1) besides the answer

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
