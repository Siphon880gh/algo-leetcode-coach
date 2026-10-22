## Return times

1. Sort by (timestamp, MESSAGE after OFFLINE).
2. OFFLINE t u: back[u] = t + 60.
3. MESSAGE: ALL adds 1 to everyone; HERE adds 1 to each u with back[u] ≤ t; otherwise add 1 per id token, duplicates included.

Examples → [2, 2], [2, 2], [0, 1].

Treating a user as online only after t + 60: example 1 → [1, 2] instead of [2, 2].

Time: O(e log e + e · users)  
Space: O(users)

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
