## Board, then pick a gap

1. Sort `buses` and `passengers`; `j = 0`.
2. For each bus `b`: `c = 0`; while `c < capacity` and `passengers[j] ≤ b`: `c++`, `j++`.
3. `j−−`. `t = buses[−1]` if the last bus has `c < capacity`, else `t = passengers[j]`.
4. While `j ≥ 0` and `passengers[j] = t`: `t−−`, `j−−`.
5. Return `t`.

Examples → 16, 20. Checked against trying every arrival time on 400 random cases.

Arriving just before the last boarded passenger takes their seat, since earlier arrivals board first. Times you cannot use are exactly a run of consecutive boarded passengers, so walking back through them finds the first free minute.

Time: O(n log n + m log m)  
Space: O(1) beyond sorting

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
