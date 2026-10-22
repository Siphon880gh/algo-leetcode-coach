## Case on odd degrees

1. Collect the odd-degree nodes `o`; store edges in hash sets.
2. `|o| = 0`: true.
3. `|o| = 2` with `a, b`: true if `a, b` are not adjacent, or some other node is adjacent to neither.
4. `|o| = 4`: true if some pairing `(a,b)(c,d)`, `(a,c)(b,d)` or `(a,d)(b,c)` has both pairs non-adjacent.
5. Otherwise false.

Examples → true, true, false. Checked against trying every set of at most two new edges on 300 random graphs.

The number of odd nodes is always even. With two of them already adjacent, a third node c must take both new edges, so c needs no edge to either. Scanning for c costs O(n).

Time: O(n + m)  
Space: O(n + m)

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
