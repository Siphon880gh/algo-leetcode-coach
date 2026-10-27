## Polynomials as maps

A polynomial is `{term: coef}`, where `term` is a sorted tuple of variables (`()` for the constant).

- **Add / subtract:** merge the maps, adding or subtracting coefficients.
- **Multiply:** for every pair of terms, the product term is the sorted concatenation of the two tuples, and the coefficient is the product.

**Parsing:** tokenize into numbers, names, operators, and parentheses. Use two-level precedence (or a shunting-yard stack): `expr = term (± term)*`, `term = factor (* factor)*`, `factor = number | name | ( expr )`. A name with a value in the evaluation map becomes a constant.

**Output:** drop zero coefficients. Sort by degree descending, then by the term's variables lexicographically. Write each as `"coef*a*b"`, or just `"coef"` for the constant.

Do not expand by string manipulation; the map form makes collecting like terms automatic. Do not forget to sort the variables inside each term, or `a*b` and `b*a` stay separate.

Time: polynomial in the expression size (multiplication can square the number of terms)  
Space: proportional to the number of terms

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
