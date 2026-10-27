## Best beauty up to a price

1. Sort items by price; `mx[i]` = max beauty of `items[0 … i]`.
2. Query `q`: `j = bisect_right(prices, q)`; answer `mx[j − 1]` if `j > 0`, else 0.

Examples → `[2,4,5,5,6,6]`, `[4]`, `[0]`.

The prefix maximum turns "best beauty among affordable items" into one lookup. Sorting the queries too and sweeping with a pointer is an equivalent offline approach.

Time: O((n + q) log n)  
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
