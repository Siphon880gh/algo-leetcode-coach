nums holds only the values 1, 2 and 3, and locked is a 0/1 array of the same length. Neighbors i and i + 1 may be swapped when nums[i] is exactly one more than nums[i + 1] and index i is unlocked; unlocking an index costs one operation. Return the fewest unlocks that let nums be sorted, or −1 if that is impossible. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two spans

1. If some 3 comes before some 1, return −1.
2. Answer the number of locked indices in [first 2, last 1) ∪ [first 3, last 2) (an empty range when a value is missing).

Constructed checks (run in code): [2, 1] with locked [1, 0] → 1; [1, 3, 2] with [0, 1, 0] → 1; [3, 1] → −1. Checked against trying every set of unlocks with a search over swaps on 500 random cases.

Unlocking only where a neighbor pair is out of order: [2, 2, 1] with [1, 1, 0] → 1 instead of 2.

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
