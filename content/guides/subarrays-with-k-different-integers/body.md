## Exact from two "at most" counts

`atMost(k)`: `count = {}`, `left = 0`, `res = 0`. For each `right`:

1. Add `nums[right]` to `count`.
2. While `len(count) > k`: remove `nums[left]` (delete at 0), `left += 1`.
3. `res += right − left + 1` (every subarray ending at `right` that starts in the window).

Return `atMost(k) − atMost(k − 1)`.

Values are between 1 and n, so arrays work instead of maps.

A one-pass version keeps two left pointers (for k and k − 1 distinct) at once.

Do not try to count "exactly k" with a single shrinking window; it misses windows that could start later with the same set. Do not enumerate subarrays; that is O(n²).

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
