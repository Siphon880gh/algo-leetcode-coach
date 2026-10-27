## Offers or list price

`best(needs)`:

1. Start with `cost = Σ needs[i] · price[i]` (no offers).
2. For each offer: if `offer[i] ≤ needs[i]` for every item, try `offer[-1] + best(needs − offer)`.
3. Return the minimum, and memoize it on `tuple(needs)`.

There are at most 6 items with at most 10 each, so there are few distinct states. Dropping offers that cost more than buying their items at list price first also cuts the search.

Do not allow an offer that gives more of an item than you need; the problem forbids buying extra, even when it is cheaper. Do not forget the list-price option; sometimes no offer is worth it.

Time: O(states · offers · items)  
Space: O(states)

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
