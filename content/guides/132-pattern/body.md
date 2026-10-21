## Fix the "3", remember the best "2"

Scan from right to left. Keep `two = −infinity`: the largest value seen so far that has a bigger value to its left already processed — a valid `nums[k]` with a `nums[j]` partner. Keep a stack of candidates for `nums[k]`.

For each `x`:

- If `x < two`, then `x` is `nums[i]`, and you have `x < two < (the value that popped it)`. Return true.
- While the stack top is less than `x`, pop it into `two`. Here `x` acts as `nums[j]`, and each popped value is a `nums[k]` to its right that is smaller. Popping in order leaves `two` as the largest one.
- Push `x`.

The stack stays decreasing from bottom to top. Each value is pushed and popped once.

A prefix-minimum plus sorted-set approach is O(n log n). The triple loop is O(n³).

Next Greater Element (496 / 503) uses the same monotonic stack. Increasing Triplet Subsequence (334) wants low, mid, high in order — a different shape.

Do not compare only adjacent values — the three indices can be far apart. Do not reset `two` once set; it only grows.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
