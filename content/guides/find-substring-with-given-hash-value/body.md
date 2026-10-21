## Add on the left, drop on the right

1. `pk = p^k mod m`; `h = 0`.
2. For `i = n − 1 … 0`: `h = (h · p + val(s[i])) mod m`; if `i + k < n`, `h = (h − val(s[i + k]) · pk) mod m`.
3. When `i + k ≤ n` and `h == hashValue`, record `i`; return the last recorded (leftmost) window.

Examples → `ee`, `fbx`. Checked against direct hashing of every window on random strings.

Rolling left to right would need to divide by p, which may have no inverse because m need not be prime. Keep every value reduced mod m and fix negatives after the subtraction.

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
