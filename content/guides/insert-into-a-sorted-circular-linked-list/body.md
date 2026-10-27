You are given a node somewhere in a circular linked list whose values are sorted in non-decreasing order around the circle (the given node need not be the smallest). Insert a new value so the list stays sorted and circular, and return the given node; if the list is empty, return a new single-node circle. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three insertion spots

Empty list: make `node.next = node` and return it.

Otherwise start with `prev = head`, `cur = head.next`, and loop:

1. `prev.val ≤ x ≤ cur.val`: insert between them.
2. `prev.val > cur.val` (the wrap from max to min) and (`x ≥ prev.val` or `x ≤ cur.val`): `x` is a new max or min, so insert at the wrap.
3. Advance. If `prev` comes back to `head`, every value is equal (or the loop found no spot); insert after `prev`.

Insertion is `prev.next = Node(x, cur)`. Return the original `head`.

Do not assume `head` is the smallest node. Do not loop forever on a list like `[3,3,3]`; stop after one full circle.

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
