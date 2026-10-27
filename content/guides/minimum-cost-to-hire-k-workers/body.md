## One worker sets the rate

Pay must be proportional to quality and at least each minimum wage. So the group is paid `rate · quality[i]` with `rate = max(wage[i] / quality[i])` over the group, and the cost is `rate · (sum of qualities)`.

1. Sort workers by `wage / quality` ascending.
2. Walk in that order with a max-heap of qualities and `sumQ`.
3. Push the current quality and add it to `sumQ`. If the heap has more than `k` items, pop the largest and subtract it.
4. When the heap has exactly `k` items, the current worker has the highest ratio among them: `best = min(best, ratio · sumQ)`.

Return `best`.

Popping the largest quality keeps `sumQ` as small as possible for every future rate.

Do not pick the cheapest minimum wages; the rate setter changes everyone's pay. Do not try all groups of size `k`.

Time: O(n log n)  
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
