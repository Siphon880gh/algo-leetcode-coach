## One character at a time

For each character `c`:

- If `'A' ≤ c ≤ 'Z'`, output `chr(ord(c) + 32)`, which equals `chr(ord(c) | 32)`.
- Otherwise, output `c` unchanged.

Join the results. In ASCII, uppercase and lowercase letters differ only in bit 5 (value 32).

The built-in `lower()` is fine in practice; the manual version shows the ASCII layout, which is what interviewers ask for.

Do not add 32 to every character; digits and punctuation would change. Do not use `^ 32` blindly; it also turns lowercase into uppercase.

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
