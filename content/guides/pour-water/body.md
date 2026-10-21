Given terrain `heights`, a number of water units `volume`, and a drop index `k`, drop the units one at a time at `k`. Each unit moves left if that eventually lets it fall lower, otherwise right if that lets it fall lower, otherwise it stays at `k`. Once it moves in a direction, it settles at the lowest point it can reach that way, taking the one nearest `k` on ties. Return the final heights, counting water as height. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One unit at a time

For each of the `volume` units:

1. **Left:** `best = k`. For `i = k − 1` down to 0: stop if `h[i] > h[i + 1]` (uphill). If `h[i] < h[best]`, set `best = i`. If `best ≠ k`, do `h[best] += 1` and move to the next unit.
2. **Right:** the same scan for `i = k + 1` upward. If `best ≠ k`, do `h[best] += 1` and continue.
3. Otherwise, `h[k] += 1`.

Updating `best` only on **strictly** lower keeps the position nearest `k` among equal lows; that is the tie rule. Moving across flat ground is allowed, but the unit only moves if it eventually drops.

Treat the edges as infinitely high walls, so water never leaves the array.

Do not move to the first lower cell and stop there; the unit keeps rolling to the lowest reachable point. Do not try the right side when the left side already has a lower spot.

Time: O(volume · n)  
Space: O(1)

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
