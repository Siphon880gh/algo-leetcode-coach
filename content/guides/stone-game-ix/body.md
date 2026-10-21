## Residues decide

1. `c0, c1, c2` = counts of values ≡ 0, 1, 2 (mod 3).
2. If `c0` is even: return `c1 ≥ 1 and c2 ≥ 1`.
3. Else: return `|c1 − c2| > 2`.

Examples → true, false, false. Checked against a full game search on random stone sets.

After the first non-zero stone the running sum is forced into a pattern like 1, 2, 1, 2 … (starting with a 1) or 2, 1, 2, 1 … (starting with a 2); zeros are pass moves that each swap who has to continue the pattern. Bob also wins if the stones run out, which is why an even `c0` with one residue missing loses for Alice.

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
