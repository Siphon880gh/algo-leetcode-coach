## Reset on a non-increase

Keep `cur` and `best`, both starting at 1. For `i ≥ 1`:

- `nums[i] > nums[i − 1]` → `cur += 1`.
- Otherwise → `cur = 1`.
- `best = max(best, cur)`.

"Continuous" means a subarray, so a single break ends the streak. "Increasing" is strict, so equal neighbors also reset it.

Do not confuse this with the longest increasing subsequence (problem 300), which may skip elements. Do not use `≥`; `[2,2,2]` → 1.

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
