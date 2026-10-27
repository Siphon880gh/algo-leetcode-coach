## Drop a negative prefix

Let `f` be the best sum of a subarray that **ends at the current index**. Then `f = max(f, 0) + x`: if the run so far is negative, start fresh at `x`. The answer is the max `f` seen.

Seed `ans = f = nums[0]`, then walk the rest. You must seed from the first element so an all-negative array still returns its largest (least negative) value — empty is not allowed.

O(n²) left/right bounds are too slow. Divide-and-conquer (best left half, best right half, best crossing the mid) is also O(n) after the log, but Kadane is the one-pass form of the same idea.

**Time:** O(n)  
**Space:** O(1)

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
