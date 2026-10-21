## Nearest on each side

1. Left pass: `prev = −∞`. For each `i`: if `s[i] == c`, `prev = i`. `ans[i] = i − prev`.
2. Right pass: `nxt = +∞`. For `i` from the end: if `s[i] == c`, `nxt = i`. `ans[i] = min(ans[i], nxt − i)`.

Use a large sentinel like `−n` and `2n` instead of infinities to keep the arithmetic in integers.

Do not search outward from every index; that is O(n²) in the worst case. Do not do only one pass; the closest occurrence may be on either side.

Time: O(n)  
Space: O(n) for the output

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
