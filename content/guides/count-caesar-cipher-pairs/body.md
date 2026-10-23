## Normalize

1. key(w) = ((c − w[0]) mod 26 for each letter c).
2. cnt[key]++ for every word.
3. Return Σ cnt · (cnt − 1) / 2.

Examples → 1, 2. Checked against trying all 26 shifts on 1,000 random lists.

Dropping the mod 26: example 2 → 1 instead of 2 ("ab" and "za" no longer match).

Time: O(n · m)  
Space: O(n · m)

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
