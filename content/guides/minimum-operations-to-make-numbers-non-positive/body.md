You get an array nums and two integers x and y, with x larger than y. In one operation you choose an index, subtract x from that element and subtract y from every other element. Return the fewest operations that make every element zero or less. The exact limits are in the official statement. For instance, nums = [5, 2], x = 3, y = 1 needs 2 operations: choose index 0 both times. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Feasibility test

1. `ok(t)`: sum over v of `ceil(max(0, v − t · y) / (x − y))`, and check it is at most t.
2. Binary search the smallest t with `ok(t)`, from 0 up to a count that surely works; with y ≥ 1, max(nums) does.

Constructed checks: [5, 2] with x = 3, y = 1 → 2; [6, 6, 1] with x = 4, y = 1 → 3. Checked against breadth-first search over every sequence of operations on 200 random small inputs.

Choosing an element gives it x − y more than the others lose, so only the extra amount matters.

Time: O(n log max)  
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
