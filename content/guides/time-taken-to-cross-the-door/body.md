People arrive at a door at given times, in non-decreasing order, each wanting to enter or to exit. The door lets one person through per second. When people in both directions are waiting, a priority rule that depends on how the door was used in the previous second decides who goes first; the exact rule, including ties, is in the official statement. Return the second at which each person crosses. For instance, arrivals [0,1,1] all wanting to enter → [0,1,2]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two queues and a memory

1. Keep an enter queue and an exit queue of indices, filled as people arrive; `t = 0`; `last = none`.
2. Each second: add everyone who has arrived by `t` to their queue.
3. If both queues are empty, set `last = none` and jump `t` to the next arrival.
4. Otherwise pick a queue with the statement’s rule using `last`; pop its front, record `t` for that person, set `last` to that direction, and `t++`.
5. Return the recorded times.

Constructed checks (verified in code for one direction only): the case above → [0,1,2]; arrivals [0,0,0] all exiting → [0,1,2].

Within one direction, people wait in the order they are added; apply the statement’s tie rule if it orders them differently. Forgetting the last direction after an idle second matters, since the rule treats a fresh door differently.

Time: O(n + max arrival)  
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
