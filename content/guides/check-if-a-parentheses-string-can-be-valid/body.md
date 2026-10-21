## Upper bounds from both sides

1. `n` odd → false.
2. Left to right: `+1` for unlocked or `(`, `−1` for a locked `)`; if it ever goes negative, false.
3. Right to left: `+1` for unlocked or `)`, `−1` for a locked `(`; if negative, false.
4. Otherwise true.

Examples → true, true, false, true. Checked against trying every assignment of unlocked characters on random strings.

Each sweep checks that locked brackets on one side can always be matched by something; with even length, passing both is also sufficient. A stack of locked `(` positions and free positions is an equivalent method.

Time: O(n)  
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
