An intersection joins two roads, and a traffic light lets only one road be green at a time. Cars arrive concurrently on different threads. For each car you are given its road and two callbacks: one switches the light to that car's road, and one lets the car cross. Make sure no car crosses on a red road and the light is switched only when needed. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Serialize arrivals

1. Keep `green`, the road that is currently green (the starting road is set by the statement).
2. On each arrival, take the lock.
3. If `green ≠ road`, call the switch callback and set `green = road`.
4. Call the cross callback, then release the lock.

For instance, cars on road 1, road 2, then road 1 cause two switches; two cars on the same road in a row cause none.

Do not switch the light on every arrival; switch only when the road changes. Do not release the lock between the switch and the crossing; another thread could flip the light in between.

Time: O(1) per car  
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
