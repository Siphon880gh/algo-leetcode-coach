Each item has a price and a weight, and the bag has a capacity. Any fraction of an item may be taken, with its price scaled by the same fraction. Return the largest total price that fills the bag exactly to capacity, or the special value the official statement gives when the items together are too light; the answer format and allowed error are also there. For instance, items (price 50, weight 1) and (price 10, weight 8) with capacity 5 → 55. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Best ratio first

1. If the total weight is below `capacity`, return the statement’s special value.
2. Sort items by `price / weight`, largest first; compare `p1 · w2` with `p2 · w1` to avoid rounding.
3. Take each item whole while it fits; then take `capacity / weight` of the next one and stop.
4. Return the total price as a floating-point number.

Constructed check (verified in code): the case above → 55.

Swapping weight from a worse ratio to a better one never lowers the price, so the greedy is optimal. Only the last item taken is split.

Time: O(n log n)  
Space: O(1) besides sorting

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
