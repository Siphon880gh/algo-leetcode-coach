Given the head of a linked list, delete every node whose value appears more than once in the list (all copies), and return the head. For instance, [1,2,3,2] → [1,3], [2,1,1,2] → [], and [3,2,2,1,3,2,4] → [1,4]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two passes

1. Count values over the list.
2. `prev = dummy` (pointing at head). For each node: if `count[val] > 1`, `prev.next = node.next`; else `prev = node`.
3. Return `dummy.next`.

Constructed checks (verified with code): the three cases above → `[1,3]`, `[]`, `[1,4]`.

The dummy node handles deleting the head. Do not keep the first copy; every copy of a duplicated value goes.

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
