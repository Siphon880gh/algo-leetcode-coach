## Only the car ahead matters

Cars cannot pass, so a car either reaches the target alone or catches the car ahead and slows to its speed.

1. Pair each position with its speed and sort by position, largest first.
2. `fleets = 0`, `slowest = 0` (the arrival time of the fleet just ahead).
3. For each car, `t = (target − position) / speed`. If `t > slowest`, it cannot catch up: `fleets += 1`, `slowest = t`. Otherwise it joins that fleet.

Return `fleets`.

A car that catches up exactly at the target counts as the same fleet, so use `>` and not `≥`.

Do not sort by speed; a fast car far behind may never catch anyone. Do not simulate time steps.

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
