Given a list of distinct strings of equal length, decide whether two of them differ in exactly one position. For instance, `["abcd","acbd","aacd"]` → true ("abcd" and "aacd" differ only at index 1). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Masked rolling hash

1. Precompute each string's polynomial hash `H`.
2. For each position j: masked hash `H − c[j] · base^(m−1−j)` (mod p); look it up in a set for this j.
3. On a hit, compare the two strings directly to rule out collisions; return true if they differ at exactly one place.

`["abcd","acbd","aacd"]` → true. `["ab","cd"]` → false.

Do not compare all pairs character by character (O(n² m)). A simpler O(n · m²) version stores masked strings directly in a set.

Time: O(n · m)  
Space: O(n)

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
