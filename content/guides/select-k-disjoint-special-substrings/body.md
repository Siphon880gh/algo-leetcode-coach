## At most 26 candidates

1. k = 0 → true.
2. For each letter c: start = first[c], end = last[c]; scan i from start to end, end = max(end, last[s[i]]); invalid if some first[s[i]] < start. Drop [0, n − 1].
3. Sort by end; take greedily when start > previous end. Answer count ≥ k.

Examples → true, false, true. Checked against listing every special substring on 500 random strings.

Using [first[c], last[c]] without growing it: ccbcabd, k = 3 → true instead of false.

Time: O(26 · n)  
Space: O(26)

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
