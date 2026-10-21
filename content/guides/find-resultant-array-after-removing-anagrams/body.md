## One pass

1. `out = [words[0]]`.
2. For each later `w`: if `sorted(w) ≠ sorted(out[−1])`, append `w`.

Examples → `[abba, cd]`, `[a, b, c, d, e]`.

A deleted word is an anagram of the kept word before it, so comparing with the last kept word is the same as comparing with the original neighbour. A 26-letter count instead of sorting also works.

Time: O(Σ |w| log |w|)  
Space: O(max |w|)

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
