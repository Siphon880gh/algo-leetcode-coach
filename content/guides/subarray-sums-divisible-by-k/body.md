## Same remainder, divisible difference

`count = [0] * k`, `count[0] = 1`, `s = 0`, `ans = 0`. For each `x`:

1. `s = (s + x) % k` (normalized to 0 … k − 1).
2. `ans += count[s]`.
3. `count[s] += 1`.

Return `ans`.

In languages where `%` can be negative, use `((s + x) % k + k) % k`; −1 and k − 1 are the same remainder.

Do not check every subarray; that is O(n²). Do not forget `count[0] = 1` for subarrays that start at index 0.

Time: O(n)  
Space: O(k)

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
