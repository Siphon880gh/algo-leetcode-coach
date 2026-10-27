A train line has two routes between consecutive stops, regular and express, with arrays regular and express giving the cost of each segment on each route. You start on the regular route. Moving from the regular route onto the express route costs an extra expressCost each time, and moving back to regular costs nothing. Return, for every stop after the start, the minimum cost to reach it. For instance, regular = [2,7,3], express = [1,1,8], expressCost = 4 → [2,6,9]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Regular and express states

1. `r = 0`, `e = expressCost`.
2. For each segment `i`: `r, e = min(r, e) + regular[i], min(r + expressCost, e) + express[i]`; record `min(r, e)`.

Constructed checks (verified against trying every route choice per segment on 400 random cases): the case above → [2,6,9]; regular = [4,4], express = [1,1], expressCost = 10 → [4,8].

In the first case, riding express from the start reaches the second stop for 4 + 1 + 1 = 6, and dropping back to regular for the last segment is free, giving 9. Both updates must use the old `r` and `e`.

Time: O(n)  
Space: O(1) beyond the output

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
