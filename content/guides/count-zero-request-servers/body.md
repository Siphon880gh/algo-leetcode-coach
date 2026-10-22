## Offline window

1. Sort logs by time; sort query indices by value; `cnt` = map server → requests in window.
2. For each query q: add logs with `time ≤ q`, remove logs with `time < q − x`, dropping servers whose count reaches 0.
3. Answer = `n − |cnt|`.

Examples → [1, 2], [0, 1]. Checked against scanning every log per query on 300 random cases.

Count servers, not requests: a busy server with many logs still removes only one from n. Scanning every log for every query is 10^10 steps.

Time: O(L log L + q log q)  
Space: O(n + q)

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
