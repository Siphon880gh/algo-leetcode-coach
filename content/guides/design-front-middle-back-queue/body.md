## Invariant: left has the extra element

1. `rebalance`: move from left's back to right's front while left is longer by 2+; move right's front to left's back while right is longer.
2. `pushFront` → left front; `pushBack` → right back; `pushMiddle` → if left is longer, move its back to right's front, then push to left's back.
3. `popMiddle` → pop left's back; `popFront` → left front; `popBack` → right back (or left if right is empty). Return −1 when empty; rebalance after each.

Example: pushFront 1, pushBack 2, pushMiddle 3, pushMiddle 4, then pops → 1, 3, 4, 2, −1.

With two middles, the front one is the middle, which the invariant gives. At most 1000 calls, but the deque design is O(1) anyway.

Time: O(1) per operation  
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
