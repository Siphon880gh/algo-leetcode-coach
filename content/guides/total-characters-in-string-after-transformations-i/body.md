## Letter counts

1. cnt[c] from s.
2. Each round: new[c + 1] = cnt[c] for c < z; new[a] = new[b] += cnt[z]. Work mod 10^9 + 7.
3. Answer Σ cnt.

Examples → 7, 5.

Treating z like any other letter (one character out): example 1 → 5 instead of 7. Building the string: a single z grows to a length above 2^3922 after 10^5 rounds.

Time: O(n + 26 · t)  
Space: O(26)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
