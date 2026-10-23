## Queues

1. addDriver: append to a deque. addRider: insert into an ordered map.
2. cancelRider: remove the rider if present.
3. match: if both are non-empty, pop the oldest driver and rider; else [−1, −1].

Examples → [[2, 3], [5, 1], [−1, −1]] and [[8, 8], [−1, −1]].

Matching the newest rider: example 1's first match → [2, 1] instead of [2, 3].

Time: O(1) per call  
Space: O(calls)

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
